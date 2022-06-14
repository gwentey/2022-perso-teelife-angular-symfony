import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AccueilComponent } from './accueil/accueil.component';
import { NavbarComponent } from './shared/navbar/navbar.component';
import { PresentationComponent } from './presentation/presentation.component';
import {RouterModule} from '@angular/router';
import { MentionsLegalesComponent } from './mentions-legales/mentions-legales.component';
import { InscriptionComponent } from './inscription/inscription.component';
import { ConnexionComponent } from './connexion/connexion.component';
import { FooterComponent } from './shared/footer/footer.component';
import { MotDePasseOublieComponent } from './mot-de-passe-oublie/mot-de-passe-oublie.component';
import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  declarations: [
    AccueilComponent,
    NavbarComponent,
    PresentationComponent,
    MentionsLegalesComponent,
    InscriptionComponent,
    ConnexionComponent,
    FooterComponent,
    MotDePasseOublieComponent
  ],
  imports: [
    CommonModule,
    RouterModule,
    ReactiveFormsModule
  ]
})
export class FrontModule { }
