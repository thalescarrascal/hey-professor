<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 characters', function () {
    //Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    //Act :: agir
    $request = post(route(name: 'question.store'), [
        'question' => str_repeat(string: '*', times: 260) . '?',
    ]);

    //Assert :: verificar
    $request->assertRedirect(route(name: 'dashboard'));
    assertDatabaseCount(table: 'questions', count: 1);
    assertDatabaseHas('questions', ['question' => str_repeat(string: '*', times: 260) . '?']);

});

it('should check if ends with question mark', function () {

});

it('should have at least 10 characters', function () {

});
