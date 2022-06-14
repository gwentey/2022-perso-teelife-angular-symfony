import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AccueilComponent } from './accueil/accueil.component';
import { InstitutionsComponent } from './institutions/institutions/institutions.component';
import { MagasinsComponent } from './institutions/magasins/magasins/magasins.component';
import { MapComponent } from './institutions/map/map.component';
import { UnMagasinComponent } from './institutions/magasins/un-magasin/un-magasin.component';
import { MoiComponent } from './personnage/moi/moi.component';
import { ReglaglesComponent } from './reglages/reglagles/reglagles.component';
import { UnRayonComponent } from './institutions/magasins/un-rayon/un-rayon.component';


const routes: Routes = [
  { path: 'game/accueil', component: AccueilComponent },
  { path: 'game/moi', component: MoiComponent },
  { path: 'game/reglagles', component: ReglaglesComponent },
  { path: 'game/institutions/map', component: MapComponent },
  { path: 'game/institutions/institutions/:ville', component: InstitutionsComponent },
  { path: 'game/institutions/magasins/:id', component: UnMagasinComponent },
  { path: 'game/institutions/magasins', component: MagasinsComponent },
  { path: 'game/institutions/magasins/:idmagasin/rayon/:idrayon', component: UnRayonComponent },

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppGameRoutingModule {

}
