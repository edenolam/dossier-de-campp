import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CampPageComponent } from './camp.page.component';
import {CampCreationPageComponent} from './camp-creation.page.component';

const routes: Routes = [
  {
    path: 'nouveau',
    component: CampCreationPageComponent
  },
  {
    path: ':idCamp',
    component: CampPageComponent
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CampRoutingModule { }
