import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AccueilComponent } from './accueil/accueil.component';
import { ConnexionComponent } from './connexion/connexion.component';
import { InscriptionComponent } from './inscription/inscription.component';
import { MentionsLegalesComponent } from './mentions-legales/mentions-legales.component';
import { MotDePasseOublieComponent } from './mot-de-passe-oublie/mot-de-passe-oublie.component';
import { PresentationComponent } from './presentation/presentation.component';
import { NavbarComponent } from './shared/navbar/navbar.component';

const routes: Routes = [
  { path: 'accueil', component: AccueilComponent },
  { path: 'presentation', component: PresentationComponent},
  { path: 'navbar', component: NavbarComponent},
  { path: 'mentions-legales', component: MentionsLegalesComponent},
  { path: 'inscription', component: InscriptionComponent},
  { path: 'connexion', component: ConnexionComponent},
  { path: 'mot-de-passe-oublie', component: MotDePasseOublieComponent},

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppFrontRoutingModule {

}
