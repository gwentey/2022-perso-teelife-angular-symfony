import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Location } from '@angular/common';

import { IPanier } from 'src/app/game/shared/interfaces/panier';
import { IPersonnage } from 'src/app/game/shared/interfaces/personnage';
import { IProduitRayon } from 'src/app/game/shared/interfaces/produitRayon';
import { IRayon } from 'src/app/game/shared/interfaces/rayon';
import { PanierService } from 'src/app/shared/panier.service';
import { PersonnageService } from 'src/app/shared/personnage.service';
import { RayonService } from 'src/app/shared/rayon.service';
import { UtilisateurService } from 'src/app/shared/utilisateur.service';

declare const navbarShow: any;
declare const animation: any;
declare const paiementAnimation: any;
declare const erreurPaiementAnimation: any;
declare const valideePaiementAnimation: any;
declare const resetPaiementAnimation: any;

@Component({
  selector: 'app-un-rayon',
  templateUrl: './un-rayon.component.html',
  styleUrls: ['../../../game-component.scss', './un-rayon.component.scss']
})
export class UnRayonComponent implements OnInit {

  public idRayon!: Number;
  public produits: any[] = [];
  public rayon!: IRayon;
  public idMagasin!: Number;
  public currentPanier!: IPanier;
  public personnage!: IPersonnage;
  public quantite: Number = 0;
  public panier!: IPanier;
  public compositionPanier!: any;
  public total: number = 0;
  public reset: Boolean = false;

  constructor(private rayonService: RayonService, private route: ActivatedRoute, private panierService: PanierService,
    private personnageService: PersonnageService, private utilisateurService: UtilisateurService,
    public _router: Router, public _location: Location) { }

  ngOnInit(): void {


    this.idRayon = Number(this.route.snapshot.paramMap.get('idrayon'));
    this.idMagasin = Number(this.route.snapshot.paramMap.get('idmagasin'));


    this.rayonService.getLeRayon(this.idRayon).subscribe({
      next: rayon => this.rayon = rayon
    })

    this.rayonService.getProduitByRayon(this.idRayon).subscribe({
      next: produits => {
        this.produits = produits
        // on initialise les champs du type any à 1
        for (let index = 0; index < this.produits.length; index++) {
          this.produits[index].quantite_choix = 1;
        }
      }
    });



  }

  ajouterAuPanier(produitRayon: IProduitRayon, quantite: Number): void {

    if(!this.reset){
    // récupération de l'utilisateur connecté
    this.utilisateurService.getUtilisateurById(this.utilisateurService.getCurrentUtilisateur()).subscribe({
      next: utilisateur => {

        // récupérération du personnage utilisé (defaut 0)
        this.personnageService.getPersonnageById(utilisateur.personnages[0].id).subscribe({
          next: personnage => {
            this.personnage = personnage;

            // récuperation du panier courrent (sinon création)
            this.panierService.getCurrentPanier(this.idMagasin, this.personnage.id).subscribe({
              next: currentPanier => {
                this.currentPanier = currentPanier;

                // le panier est vide ?
                if (Array.isArray(this.currentPanier) && this.currentPanier.length) {
                  // panier pas vide alors on insert le produit dans le panier
                  this.panierService.ajouterUnProduitDansUnPanier(this.currentPanier[0].id, produitRayon.id, quantite).subscribe({
                    next: () => console.log("Produit ajouté")
                  })

                } else {
                  // on crée un panier
                  this.panierService.creePanier(this.idMagasin, this.personnage.id).subscribe({
                    next: panier => {
                      console.log("Panier crée"),
                        //puis on ajoute le produit
                        this.panierService.ajouterUnProduitDansUnPanier(panier.id, produitRayon.id, quantite).subscribe({
                          next: () => console.log("Produit ajouté")
                        })
                    }
                  });
                }
              }
            })
          }
        })
      }
    })
} else {
  this.refresh()

}
}

  afficherPanier(): void {

    if(!this.reset){
      // récupération de l'utilisateur connecté
    this.utilisateurService.getUtilisateurById(this.utilisateurService.getCurrentUtilisateur()).subscribe({
      next: utilisateur => {

        // récupérération du personnage utilisé (defaut 0)
        this.personnageService.getPersonnageById(utilisateur.personnages[0].id).subscribe({
          next: personnage => {
            this.personnage = personnage;

            // récuperation du panier courrent (sinon création)
            this.panierService.getCurrentPanier(this.idMagasin, this.personnage.id).subscribe({
              next: currentPanier => {
                this.currentPanier = currentPanier;

                // le panier est vide ?
                if (Array.isArray(this.currentPanier) && this.currentPanier.length) {
                  // panier pas vide alors on affiche le panier
                  this.panier = this.currentPanier;
                  console.log("Affichage panier"),
                    this.compositionPanier = this.panier[0].compositionPaniers

                  // calcul du total
                  this.compositionPanier.forEach(element => {
                    this.total = Number(element.id_produitRayon.prix * element.quantite) + Number(this.total)
                  });

                } else {
                  // on crée un panier
                  this.panierService.creePanier(this.idMagasin, this.personnage.id).subscribe({
                    next: panier => {
                      console.log("Panier crée")
                      //puis on affiche le panier
                      this.panier = panier;
                      this.compositionPanier = this.panier[0].compositionPaniers;
                    }
                  });
                }
              }
            })
          }

        })
      }
    })
   } else {
    this.refresh()
  }
}

	 public refresh() : void{
     this.reset = false;
		this._router.navigateByUrl("/refresh", { skipLocationChange: true }).then(() => {
		console.log(decodeURI(this._location.path()));
		this._router.navigate([decodeURI(this._location.path())]);
		});
  }

  public payerEnArgentLiquide() {
    // le personnage peut-il payer ?
    if (this.personnage.situationPersonnage.argent_liquide > this.total) {
      valideePaiementAnimation();
      this.panierService.signalerPanierPayer(this.panier[0].id).subscribe({
        next: () => console.log("Panier payé")
      })
      const nouveau_solde = this.personnage.situationPersonnage.argent_liquide - Number(this.total)
      this.personnageService.majSitationPersonnage(this.personnage.id, nouveau_solde).subscribe({
        next: () => console.log("Personne débitée")
      })

    } else {
      erreurPaiementAnimation();
    }
    this.reset = true;
  }

  public payerEnCarte() {
    // fonction non encore développer car le système bancaire nécessistant une banque, et un compte n'a pas été implémenté
    erreurPaiementAnimation();
  }



  ngAfterViewInit(): void {
    navbarShow();
    animation();
    paiementAnimation();

  }

}
