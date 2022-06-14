import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, NavigationEnd, Router } from '@angular/router';
import { IUtilisateur } from 'src/app/game/shared/interfaces/utilisateur';
import { UtilisateurService } from 'src/app/shared/utilisateur.service';

@Component({
  selector: 'app-connexion',
  templateUrl: './connexion.component.html',
  styleUrls: ['../font.component.scss', './connexion.component.scss']
})
export class ConnexionComponent implements OnInit {

  public utilisateurForm!: FormGroup;
  private _utilisateurService;
  public utilisateurs: IUtilisateur[] = [];
  public utilisateur: IUtilisateur[] = [];
  public errMsg!: string;
  public uneErreur: boolean = false;


  constructor(private fb: FormBuilder, private utilisateurService: UtilisateurService, private router: Router) {
  }

  ngOnInit(): void {
    this.utilisateurService.getUtilisateur().subscribe({
      next: utilisateurs => this.utilisateurs = utilisateurs,
      error: err => this.errMsg = err
    });

    this.utilisateurForm = this.fb.group({
      utilisateurPseudo: [
        '',
        [
          Validators.required,
          Validators.minLength(1),
          Validators.maxLength(15)
        ]
      ],
      utilisateurPassword: ['', Validators.required]
    });

  }

  public connexionUtilisateur(): void {

    if (this.utilisateurForm.valid) {
      if (this.utilisateurForm.dirty) {

        this.utilisateurService.getUtilisateurByPseudo(this.utilisateurForm.value.utilisateurPseudo).subscribe({
          next: utilisateur => {
            if (utilisateur) {
              if (utilisateur['password'] == this.utilisateurForm.value.utilisateurPassword) {
                this.utilisateurService.setCurrentUtilisateur(utilisateur['id']);
                this.router.navigateByUrl('game/accueil');
              }
            }
            this.uneErreur = true;
            this.utilisateurForm.reset();

          },
          error: err => this.errMsg = err
        });

      }
    }
  }

  public connexionApprouve(): void {

  }



}
