import { Component, Input, OnInit, Output } from '@angular/core';
import { PersonnageService } from 'src/app/shared/personnage.service';
import { UtilisateurService } from 'src/app/shared/utilisateur.service';
import { IPanier } from '../interfaces/panier';
import { IPersonnage } from '../interfaces/personnage';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss', '../../game-component.scss']
})
export class NavbarComponent implements OnInit {

  public personnage: IPersonnage = {
    id: 0,
    id_utilisateur: 0,
    nom: '',
    prenom: '',
    situationPersonnage: undefined,
    interactionsPersonnage: undefined,
    diplomesPersonnages: undefined,
    santePersonnage: undefined,
    id_ville: undefined,
    entreprises: undefined,
    compteBancaires: undefined,
    addictionsPersonnages: undefined
  };


  constructor(private utilisateurService: UtilisateurService, private personnageService: PersonnageService) { }

  ngOnInit(): void {
    this.utilisateurService.getUtilisateurById(this.utilisateurService.getCurrentUtilisateur()).subscribe({
      next: utilisateur => {
        this.personnageService.getPersonnageById(utilisateur.personnages[0].id).subscribe({
          next: personnage => {
            this.personnage = personnage;
          }
        })
      }
    })

  }


}
