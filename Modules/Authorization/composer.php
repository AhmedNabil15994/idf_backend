<?php

view()->composer(['user::dashboard.admins.index'], \Modules\Authorization\ViewComposers\Dashboard\AdminRolesComposer::class);


view()->composer([
  'trainer::dashboard.trainers.index',
], \Modules\Authorization\ViewComposers\Dashboard\TrainerRolesComposer::class);
