import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AccueilComponent } from './accueil/accueil.component';
import { FormsModule } from '@angular/forms';

import { RouterModule } from '@angular/router';
import { NavbarComponent } from './shared/navbar/navbar.component';
import { MoiComponent } from './personnage/moi/moi.component';
import { ProfileComponent } from './reglages/profile/profile.component';
import { ReglaglesComponent } from './reglages/reglagles/reglagles.component';
import { MapComponent } from './institutions/map/map.component';
import { InstitutionsComponent } from './institutions/institutions/institutions.component';
import { UnMagasinComponent } from './institutions/magasins/un-magasin/un-magasin.component';
import { MagasinsComponent } from './institutions/magasins/magasins/magasins.component';
import { UnRayonComponent } from './institutions/magasins/un-rayon/un-rayon.component';




@NgModule({
  declarations: [
    AccueilComponent,
    NavbarComponent,
    MoiComponent,
    ProfileComponent,
    ReglaglesComponent,
    MapComponent,
    InstitutionsComponent,
    MagasinsComponent,
    UnMagasinComponent,
    UnRayonComponent

  ],
  imports: [
    CommonModule,
    RouterModule,
    FormsModule,

  ]
})
export class GameModule { }
