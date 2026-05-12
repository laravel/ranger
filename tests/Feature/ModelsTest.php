<?php

use App\Models\ApiResponse;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Visibility;
use Laravel\Ranger\Collectors\Models;
use Laravel\Ranger\Components\Model;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\ClassType;

beforeEach(function () {
    $this->collector = app(Models::class);
});

describe('model collection', function () {
    it('collects models from the application', function () {
        $models = $this->collector->collect();

        expect($models)->not->toBeEmpty();
    });

    it('finds the User model', function () {
        $models = $this->collector->collect();
        $userModel = $models->first(fn (Model $m) => $m->name === User::class);

        expect($userModel)->not->toBeNull();
        expect($userModel)->toBeInstanceOf(Model::class);
    });

    it('finds the Post model', function () {
        $models = $this->collector->collect();
        $postModel = $models->first(fn (Model $m) => $m->name === Post::class);

        expect($postModel)->not->toBeNull();
        expect($postModel)->toBeInstanceOf(Model::class);
    });
});

describe('model attributes', function () {
    it('captures model attributes', function () {
        $models = $this->collector->collect();
        $userModel = $models->first(fn (Model $m) => $m->name === User::class);

        $attributes = $userModel->getAttributes();

        expect($attributes)->not->toBeEmpty();
    });
});

describe('model relations', function () {
    it('captures relations from models', function () {
        $models = $this->collector->collect();
        $userModel = $models->first(fn (Model $m) => $m->name === User::class);

        $relations = $userModel->getRelations();

        expect($relations)->toBeArray();
    });

    it('captures belongsTo relations on Post model', function () {
        $models = $this->collector->collect();
        $postModel = $models->first(fn (Model $m) => $m->name === Post::class);

        $relations = $postModel->getRelations();

        expect($relations)->toBeArray();
        if (count($relations) > 0) {
            expect($relations)->toHaveKey('user');
        }
    });

    it('resolves belongsTo relation to a nullable related model class', function () {
        $models = $this->collector->collect();
        $postModel = $models->first(fn (Model $m) => $m->name === Post::class);

        $relations = $postModel->getRelations();

        expect($relations)->toHaveKey('user');
        expect($relations['user'])->toBeInstanceOf(ClassType::class);
        expect($relations['user']->value)->toBe(User::class);
        expect($relations['user']->isNullable())->toBeTrue();
    });

    it('resolves hasMany relation to an array of the related model', function () {
        $models = $this->collector->collect();
        $userModel = $models->first(fn (Model $m) => $m->name === User::class);

        $relations = $userModel->getRelations();

        expect($relations)->toHaveKey('posts');
        expect($relations['posts'])->toBeInstanceOf(ArrayType::class);
        expect($relations['posts']->value[0])->toBeInstanceOf(ClassType::class);
        expect($relations['posts']->value[0]->value)->toBe(Post::class);
    });

    it('resolves hasOne relation to a nullable related model class', function () {
        $models = $this->collector->collect();
        $userModel = $models->first(fn (Model $m) => $m->name === User::class);

        $relations = $userModel->getRelations();

        expect($relations)->toHaveKey('post');
        expect($relations['post'])->toBeInstanceOf(ClassType::class);
        expect($relations['post']->value)->toBe(Post::class);
        expect($relations['post']->isNullable())->toBeTrue();
    });
});

describe('model lookup', function () {
    it('can get a specific model by name', function () {
        $this->collector->collect();

        $userModel = $this->collector->get(User::class);

        expect($userModel)->not->toBeNull();
        expect($userModel->name)->toBe(User::class);
    });

    it('returns null for non-existent models', function () {
        $this->collector->collect();

        $result = $this->collector->get('NonExistent\\Model');

        expect($result)->toBeNull();
    });
});

describe('eager loading', function () {
    it('marks eager loaded relations as required', function () {
        $models = $this->collector->collect();
        $commentModel = $models->first(fn (Model $m) => $m->name === Comment::class);

        $relations = $commentModel->getRelations();

        expect($relations)->toHaveKey('post');
        expect($relations['post']->required)->toBeTrue();
    });

    it('marks non-eager loaded relations as not required', function () {
        $models = $this->collector->collect();
        $postModel = $models->first(fn (Model $m) => $m->name === Post::class);

        $relations = $postModel->getRelations();

        expect($relations)->toHaveKey('user');
        expect($relations['user']->required)->toBeFalse();
    });

    it('matches eager load relations using snake_case version of method name', function () {
        $models = $this->collector->collect();
        $commentModel = $models->first(fn (Model $m) => $m->name === Comment::class);

        $relations = $commentModel->getRelations();

        expect($relations)->toHaveKey('authoredBy');
        expect($relations['authoredBy']->required)->toBeTrue();
    });
});

describe('serialization visibility', function () {
    it('captures the $hidden list from the model', function () {
        $models = $this->collector->collect();
        $userModel = $models->first(fn (Model $m) => $m->name === User::class);

        expect($userModel->getHidden())->toBe(['password', 'remember_token']);
    });

    it('captures the $visible list from the model', function () {
        $models = $this->collector->collect();
        $visibility = $models->first(fn (Model $m) => $m->name === Visibility::class);

        expect($visibility->getVisible())->toBe(['id', 'name', 'display_name']);
    });

    it('captures the $appends list from the model', function () {
        $models = $this->collector->collect();
        $visibility = $models->first(fn (Model $m) => $m->name === Visibility::class);

        expect($visibility->getAppends())->toBe(['display_name']);
    });

    it('defaults visibility lists to empty arrays when undefined', function () {
        $models = $this->collector->collect();
        $postModel = $models->first(fn (Model $m) => $m->name === Post::class);

        expect($postModel->getHidden())->toBe([]);
        expect($postModel->getVisible())->toBe([]);
        expect($postModel->getAppends())->toBe([]);
    });

    it('filters $hidden attributes out of visibleProperties()', function () {
        $models = $this->collector->collect();
        $userModel = $models->first(fn (Model $m) => $m->name === User::class);

        $visible = $userModel->visibleProperties();

        expect($visible)->not->toHaveKey('password');
        expect($visible)->not->toHaveKey('remember_token');
        expect($visible)->toHaveKey('email');
    });

    it('treats $visible as a whitelist in visibleProperties()', function () {
        $models = $this->collector->collect();
        $visibility = $models->first(fn (Model $m) => $m->name === Visibility::class);

        $visible = $visibility->visibleProperties();

        expect(array_keys($visible))->toEqualCanonicalizing(['id', 'name', 'display_name']);
        expect($visible)->not->toHaveKey('secret');
        expect($visible)->not->toHaveKey('internal_note');
    });
});

describe('snake case attributes', function () {
    it('defaults to snake casing attributes', function () {
        $models = $this->collector->collect();
        $userModel = $models->first(fn (Model $m) => $m->name === User::class);

        expect($userModel->snakeCaseAttributes())->toBeTrue();
    });

    it('respects models that disable snake casing', function () {
        $models = $this->collector->collect();
        $apiResponseModel = $models->first(fn (Model $m) => $m->name === ApiResponse::class);

        expect($apiResponseModel->snakeCaseAttributes())->toBeFalse();
    });
});
