<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Modules\Contact\Models\Setting\City;
use Modules\Contact\Models\Setting\Country;
use Modules\Contact\Models\Setting\State;

/****************************************** Country ******************************************/
Breadcrumbs::for('contact.settings.countries.index', function (BreadcrumbTrail $trail) {

    $trail->parent('core.settings.index');

    $trail->push('Countries', route('contact.settings.countries.index'));
});

Breadcrumbs::for('contact.settings.countries.create', function (BreadcrumbTrail $trail) {

    $trail->parent('contact.settings.countries.index');

    $trail->push('Add', route('contact.settings.countries.create'));
});

Breadcrumbs::for('contact.settings.countries.show', function (BreadcrumbTrail $trail, $country) {

    $trail->parent('contact.settings.countries.index');

    $country = ($country instanceof Country) ? $country : $country[0];

    $trail->push($country->name, route('contact.settings.countries.show', $country->id));
});

Breadcrumbs::for('contact.settings.countries.edit', function (BreadcrumbTrail $trail, Country $country) {

    $trail->parent('contact.settings.countries.show', [$country]);

    $trail->push('Edit Country', route('contact.settings.countries.edit', $country->id));
});

/****************************************** State ******************************************/
Breadcrumbs::for('contact.settings.states.index', function (BreadcrumbTrail $trail) {

    $trail->parent('core.settings.index');

    $trail->push('States', route('contact.settings.states.index'));
});

Breadcrumbs::for('contact.settings.states.create', function (BreadcrumbTrail $trail) {

    $trail->parent('contact.settings.states.index');

    $trail->push('Add State', route('contact.settings.states.create'));
});

Breadcrumbs::for('contact.settings.states.show', function (BreadcrumbTrail $trail, $state) {

    $trail->parent('contact.settings.states.index');

    $state = ($state instanceof State) ? $state : $state[0];

    $trail->push($state->display_name, route('contact.settings.states.show', $state->id));
});

Breadcrumbs::for('contact.settings.states.edit', function (BreadcrumbTrail $trail, State $state) {

    $trail->parent('contact.settings.states.show', [$state]);

    $trail->push('Edit State', route('contact.settings.states.edit', $state->id));
});

/****************************************** City ******************************************/
Breadcrumbs::for('contact.settings.cities.index', function (BreadcrumbTrail $trail) {

    $trail->parent('core.settings.index');

    $trail->push('Cities', route('contact.settings.cities.index'));
});

Breadcrumbs::for('contact.settings.cities.create', function (BreadcrumbTrail $trail) {

    $trail->parent('contact.settings.cities.index');

    $trail->push('Add City', route('contact.settings.cities.create'));
});

Breadcrumbs::for('contact.settings.cities.show', function (BreadcrumbTrail $trail, $city) {

    $trail->parent('contact.settings.cities.index');

    $city = ($city instanceof City) ? $city : $city[0];

    $trail->push($city->name, route('contact.settings.cities.show', $city->id));
});

Breadcrumbs::for('contact.settings.cities.edit', function (BreadcrumbTrail $trail, City $city) {

    $trail->parent('contact.settings.cities.show', [$city]);

    $trail->push('Edit City', route('contact.settings.cities.edit', $city->id));
});