<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('address', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('address', function(Blueprint $table) {
			$table->foreign('family_id')->references('id')->on('families')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('family_members', function(Blueprint $table) {
			$table->foreign('family_id')->references('id')->on('families')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('family_members', function(Blueprint $table) {
			$table->foreign('nationality_id')->references('id')->on('nationalities')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('family_members', function(Blueprint $table) {
			$table->foreign('religion_id')->references('id')->on('religions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('nationality_translations', function(Blueprint $table) {
			$table->foreign('nationality_id')->references('id')->on('nationalities')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('religion_translations', function(Blueprint $table) {
			$table->foreign('religion_id')->references('id')->on('religions')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('charity_translations', function(Blueprint $table) {
			$table->foreign('charity_id')->references('id')->on('charities')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('charities', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade');
		});
		Schema::table('food_basket_translations', function(Blueprint $table) {
			$table->foreign('food_basket_id')->references('id')->on('food_baskets')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('governorate_translations', function(Blueprint $table) {
			$table->foreign('governorate_id')->references('id')->on('governorates')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->foreign('governorate_id')->references('id')->on('governorates')
						->onDelete('cascade');
		});
		Schema::table('city_translations', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
        Schema::table('regions', function(Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade');
        });
		Schema::table('region_translations', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('donate_resource_items', function(Blueprint $table) {
			$table->foreign('item_type_id')->references('id')->on('item_types')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('donate_resource_items', function(Blueprint $table) {
			$table->foreign('donate_resource_id')->references('id')->on('donate_resources')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('item_type_translations', function(Blueprint $table) {
			$table->foreign('item_type_id')->references('id')->on('item_types')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('projects', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('country_translations', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('project_translations', function(Blueprint $table) {
			$table->foreign('project_id')->references('id')->on('projects')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
        Schema::table('category_project', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade');
        });
        Schema::table('category_project', function(Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')
                ->onDelete('cascade');
        });
		Schema::table('family_food_basket', function(Blueprint $table) {
			$table->foreign('family_id')->references('id')->on('families')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('family_food_basket', function(Blueprint $table) {
			$table->foreign('food_basket_id')->references('id')->on('food_baskets')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('charity_family', function(Blueprint $table) {
			$table->foreign('family_id')->references('id')->on('families')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('charity_family', function(Blueprint $table) {
			$table->foreign('charity_id')->references('id')->on('charities')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('donations', function(Blueprint $table) {
			$table->foreign('donor_id')->references('id')->on('donors')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('donors', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('set null');
		});
		Schema::table('donations', function(Blueprint $table) {
			$table->foreign('donation_status_id')->references('id')->on('donation_statuses')
						->onDelete('cascade');
		});
		Schema::table('donation_status_translations', function(Blueprint $table) {
			$table->foreign('donation_status_id')->references('id')->on('donation_statuses')
						->onDelete('cascade');
		});
		Schema::table('donatables', function(Blueprint $table) {
			$table->foreign('donation_id')->references('id')->on('donations')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('sliders', function(Blueprint $table) {
			$table->foreign('project_id')->references('id')->on('projects')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('family_id')->references('id')->on('families')
						->onDelete('cascade')
						->onUpdate('restrict');
			$table->foreign('volunteer_id')->references('id')->on('volunteers')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('food_basket_order', function(Blueprint $table) {
			$table->foreign('food_basket_id')->references('id')->on('food_baskets')
						->onDelete('cascade')
						->onUpdate('restrict');
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('address', function(Blueprint $table) {
			$table->dropForeign('address_city_id_foreign');
		});
		Schema::table('address', function(Blueprint $table) {
			$table->dropForeign('address_family_id_foreign');
		});
		Schema::table('family_members', function(Blueprint $table) {
			$table->dropForeign('family_members_family_id_foreign');
		});
		Schema::table('family_members', function(Blueprint $table) {
			$table->dropForeign('family_members_nationality_id_foreign');
		});
		Schema::table('family_members', function(Blueprint $table) {
			$table->dropForeign('family_members_religion_id_foreign');
		});
		Schema::table('nationality_translations', function(Blueprint $table) {
			$table->dropForeign('nationality_translations_nationality_id_foreign');
		});
		Schema::table('religion_translations', function(Blueprint $table) {
			$table->dropForeign('religion_translations_religion_id_foreign');
		});
		Schema::table('charity_translations', function(Blueprint $table) {
			$table->dropForeign('charity_translations_charity_id_foreign');
		});
		Schema::table('food_basket_translations', function(Blueprint $table) {
			$table->dropForeign('food_basket_translations_food_basket_id_foreign');
		});
		Schema::table('governorate_translations', function(Blueprint $table) {
			$table->dropForeign('governorate_translations_governorate_id_foreign');
		});
		Schema::table('city_translations', function(Blueprint $table) {
			$table->dropForeign('city_translations_city_id_foreign');
		});
		Schema::table('region_translations', function(Blueprint $table) {
			$table->dropForeign('region_translations_region_id_foreign');
		});
		Schema::table('donate_resource_items', function(Blueprint $table) {
			$table->dropForeign('donate_resource_items_item_type_id_foreign');
		});
		Schema::table('donate_resource_items', function(Blueprint $table) {
			$table->dropForeign('donate_resource_items_donate_resource_id_foreign');
		});
		Schema::table('item_type_translations', function(Blueprint $table) {
			$table->dropForeign('item_type_translations_item_type_id_foreign');
		});
		Schema::table('projects', function(Blueprint $table) {
			$table->dropForeign('projects_country_id_foreign');
		});
		Schema::table('country_translations', function(Blueprint $table) {
			$table->dropForeign('country_translations_country_id_foreign');
		});
		Schema::table('project_translations', function(Blueprint $table) {
			$table->dropForeign('project_translations_project_id_foreign');
		});
		Schema::table('family_food_basket', function(Blueprint $table) {
			$table->dropForeign('family_food_basket_family_id_foreign');
		});
		Schema::table('family_food_basket', function(Blueprint $table) {
			$table->dropForeign('family_food_basket_food_basket_id_foreign');
		});
		Schema::table('charity_family', function(Blueprint $table) {
			$table->dropForeign('charity_family_family_id_foreign');
		});
		Schema::table('charity_family', function(Blueprint $table) {
			$table->dropForeign('charity_family_charity_id_foreign');
		});
		Schema::table('donations', function(Blueprint $table) {
			$table->dropForeign('donations_donor_id_foreign');
		});
		Schema::table('donatables', function(Blueprint $table) {
			$table->dropForeign('donatables_donation_id_foreign');
		});
		Schema::table('sliders', function(Blueprint $table) {
			$table->dropForeign('sliders_project_id_foreign');
		});
	}
}