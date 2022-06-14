import { Injectable } from '@angular/core';
import { IUtilisateur } from '../game/shared/interfaces/utilisateur';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { catchError, Observable, tap, throwError } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class UtilisateurService {

  private readonly UTILISATEUR_API_URL = "https://127.0.0.1:8000/api/utilisateur";
  private utilisateur!: IUtilisateur;

  constructor(private http: HttpClient) { }


  public getUtilisateur(): Observable<IUtilisateur[]> {

    return this.http.get<IUtilisateur[]>(this.UTILISATEUR_API_URL).pipe(
      tap(utilisateurs => console.log('utilisateurs:', utilisateurs)),
      catchError(this.handleError)
    );
  }

  public getUtilisateurByPseudo(pseudo: string): Observable<IUtilisateur[]> {

    return this.http.get<IUtilisateur[]>(this.UTILISATEUR_API_URL + "/pseudo/" + pseudo).pipe(
      tap(utilisateurs => console.log('utilisateurs:', utilisateurs)),
      catchError(this.handleError)
    );
  }

  public getUtilisateurById(id: Number): Observable<IUtilisateur> {

    return this.http.get<IUtilisateur>(this.UTILISATEUR_API_URL + "/" + id).pipe(
      catchError(this.handleError)
    );
  }

  public setCurrentUtilisateur(id: string): void {
    localStorage.setItem("id", id);
  }

  public getCurrentUtilisateur(): Number {
    return Number(localStorage.getItem("id"));
  }


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
