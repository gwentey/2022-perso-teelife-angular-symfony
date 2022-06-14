import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { catchError, Observable, tap, throwError } from 'rxjs';
import { IPersonnage } from '../game/shared/interfaces/personnage';
import { IUtilisateur } from '../game/shared/interfaces/utilisateur';
import { UtilisateurService } from './utilisateur.service';

@Injectable({
  providedIn: 'root'
})
export class PersonnageService {

  private readonly PERSONNAGE_API_URL = "https://127.0.0.1:8000/api/personnage";
  private personnage !: IPersonnage;
  private utilisateur !: IUtilisateur;

  constructor(private http: HttpClient, private utilisateurService: UtilisateurService) { }


  public getPersonnage(): Observable<IPersonnage[]> {

    return this.http.get<IPersonnage[]>(this.PERSONNAGE_API_URL).pipe(
      tap(personnages => console.log('personnages:', personnages)),
      catchError(this.handleError)
    );

  }

  public getPersonnageById(id: Number): Observable<IPersonnage> {

    return this.http.get<IPersonnage>(this.PERSONNAGE_API_URL + "/" + id).pipe(
      catchError(this.handleError)
    );
  }


    // remettre a niveau la situation du personnage (argent liquide, etc...)
    public majSitationPersonnage(idPersonnage: Number, argentLiquide: Number): Observable<any> {

      const situation = {
        id_personnage: idPersonnage,
        argent_liquide: argentLiquide
      }

      return this.http.put<any>(this.PERSONNAGE_API_URL + "/situation/", situation).pipe(
        catchError(this.handleError)
      );

    }






  /*   public getUtilisateurById(id: Number): Observable<IPersonnage> {

      return this.http.get<IPersonnage>(this.PERSONNAGE_API_URL + "/" + id).pipe(
        catchError(this.handleError)
      );
    } */



  private handleError(error: HttpErrorResponse) {
    if (error.status === 0) {
      // A client-side or network error occurred. Handle it accordingly.
      console.error('An error occurred:', error.error);
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong.
      console.error(
        `Backend returned code ${error.status}, body was: `, error.error);
    }
    // Return an observable with a user-facing error message.
    return throwError(() => new Error('Something bad happened; please try again later.'));
  }
}
