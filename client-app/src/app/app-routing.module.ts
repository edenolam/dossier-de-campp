import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';


const routes: Routes = [
  { path: 'camp', loadChildren: () => import('./camp/camp.module').then(m => m.CampModule) },
  { path: 'accueil', loadChildren: () => import('./accueil/accueil.module').then(m => m.AccueilModule) },
  { path: '', redirectTo: '/accueil', pathMatch: 'full' },
  { path: '**', redirectTo: '/accueil' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
