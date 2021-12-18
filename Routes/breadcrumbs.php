<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Modules\Contact\Models\Setting\BloodGroup;
use Modules\Contact\Models\Setting\City;
use Modules\Contact\Models\Setting\Country;
use Modules\Contact\Models\Setting\Gender;
use Modules\Contact\Models\Setting\Occupation;
use Modules\Contact\Models\Setting\Relation;
use Modules\Contact\Models\Setting\Religion;
use Modules\Contact\Models\Setting\State;

/****************************************** Country ******************************************/
Breadcrumbs::for('contact.settings.countries.index', function (BreadcrumbTrail $trail) {

    $trail->parent('core.settings.index');

    $trail->push('Countries', route('contact.settings.countries.index'));
});

Breadcrumbs::for('contact.settings.countries.create', function (BreadcrumbTrail $trail) {

    $trail->parent('contact.settings.countries.index');

    $trail->push('Add Country', route('contact.settings.countries.create'));
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

    $trail->push($state->name, route('contact.settings.states.show', $state->id));
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

/****************************************** Gender ******************************************/
Breadcrumbs::for('contact.settings.genders.index', function (BreadcrumbTrail $trail) {

    $trail->parent('core.settings.index');

    $trail->push('Genders', route('contact.settings.genders.index'));
});

Breadcrumbs::for('contact.settings.genders.create', function (BreadcrumbTrail $trail) {

    $trail->parent('contact.settings.genders.index');

    $trail->push('Add Gender', route('contact.settings.genders.create'));
});

Breadcrumbs::for('contact.settings.genders.show', function (BreadcrumbTrail $trail, $gender) {

    $trail->parent('contact.settings.genders.index');

    $gender = ($gender instanceof Gender) ? $gender : $gender[0];

    $trail->push($gender->name, route('contact.settings.genders.show', $gender->id));
});

Breadcrumbs::for('contact.settings.genders.edit', function (BreadcrumbTrail $trail, Gender $gender) {

    $trail->parent('contact.settings.genders.show', [$gender]);

    $trail->push('Edit Gender', route('contact.settings.genders.edit', $gender->id));
});

/****************************************** Blood Group ******************************************/
Breadcrumbs::for('contact.settings.blood-groups.index', function (BreadcrumbTrail $trail) {

    $trail->parent('core.settings.index');

    $trail->push('Blood Groups', route('contact.settings.blood-groups.index'));
});

Breadcrumbs::for('contact.settings.blood-groups.create', function (BreadcrumbTrail $trail) {

    $trail->parent('contact.settings.blood-groups.index');

    $trail->push('Add Blood Group', route('contact.settings.blood-groups.create'));
});

Breadcrumbs::for('contact.settings.blood-groups.show', function (BreadcrumbTrail $trail, $bloodGroup) {

    $trail->parent('contact.settings.blood-groups.index');

    $bloodGroup = ($bloodGroup instanceof BloodGroup) ? $bloodGroup : $bloodGroup[0];

    $trail->push($bloodGroup->name, route('contact.settings.blood-groups.show', $bloodGroup->id));
});

Breadcrumbs::for('contact.settings.blood-groups.edit', function (BreadcrumbTrail $trail, BloodGroup $bloodGroup) {

    $trail->parent('contact.settings.blood-groups.show', [$bloodGroup]);

    $trail->push('Edit Blood Group', route('contact.settings.blood-groups.edit', $bloodGroup->id));
});

/****************************************** Occupation ******************************************/
Breadcrumbs::for('contact.settings.occupations.index', function (BreadcrumbTrail $trail) {

    $trail->parent('core.settings.index');

    $trail->push('Occupations', route('contact.settings.occupations.index'));
});

Breadcrumbs::for('contact.settings.occupations.create', function (BreadcrumbTrail $trail) {

    $trail->parent('contact.settings.occupations.index');

    $trail->push('Add Occupation', route('contact.settings.occupations.create'));
});

Breadcrumbs::for('contact.settings.occupations.show', function (BreadcrumbTrail $trail, $occupation) {

    $trail->parent('contact.settings.occupations.index');

    $occupation = ($occupation instanceof Occupation) ? $occupation : $occupation[0];

    $trail->push($occupation->name, route('contact.settings.occupations.show', $occupation->id));
});

Breadcrumbs::for('contact.settings.occupations.edit', function (BreadcrumbTrail $trail, Occupation $occupation) {

    $trail->parent('contact.settings.occupations.show', [$occupation]);

    $trail->push('Edit Occupation', route('contact.settings.occupations.edit', $occupation->id));
});

/****************************************** Relation ******************************************/
Breadcrumbs::for('contact.settings.relations.index', function (BreadcrumbTrail $trail) {

    $trail->parent('core.settings.index');

    $trail->push('Relations', route('contact.settings.relations.index'));
});

Breadcrumbs::for('contact.settings.relations.create', function (BreadcrumbTrail $trail) {

    $trail->parent('contact.settings.relations.index');

    $trail->push('Add Relation', route('contact.settings.relations.create'));
});

Breadcrumbs::for('contact.settings.relations.show', function (BreadcrumbTrail $trail, $relation) {

    $trail->parent('contact.settings.relations.index');

    $relation = ($relation instanceof Relation) ? $relation : $relation[0];

    $trail->push($relation->name, route('contact.settings.relations.show', $relation->id));
});

Breadcrumbs::for('contact.settings.relations.edit', function (BreadcrumbTrail $trail, Relation $relation) {

    $trail->parent('contact.settings.relations.show', [$relation]);

    $trail->push('Edit Relation', route('contact.settings.relations.edit', $relation->id));
});

/****************************************** Religion ******************************************/
Breadcrumbs::for('contact.settings.religions.index', function (BreadcrumbTrail $trail) {

    $trail->parent('core.settings.index');

    $trail->push('Religions', route('contact.settings.religions.index'));
});

Breadcrumbs::for('contact.settings.religions.create', function (BreadcrumbTrail $trail) {

    $trail->parent('contact.settings.religions.index');

    $trail->push('Add Religion', route('contact.settings.religions.create'));
});

Breadcrumbs::for('contact.settings.religions.show', function (BreadcrumbTrail $trail, $religion) {

    $trail->parent('contact.settings.religions.index');

    $religion = ($religion instanceof Religion) ? $religion : $religion[0];

    $trail->push($religion->name, route('contact.settings.religions.show', $religion->id));
});

Breadcrumbs::for('contact.settings.religions.edit', function (BreadcrumbTrail $trail, Religion $religion) {

    $trail->parent('contact.settings.religions.show', [$religion]);

    $trail->push('Edit Religion', route('contact.settings.religions.edit', $religion->id));
});
