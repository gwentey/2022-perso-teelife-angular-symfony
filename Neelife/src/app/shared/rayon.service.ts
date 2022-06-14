import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { catchError, Observable, tap, throwError } from 'rxjs';
import { IProduit } from '../game/shared/interfaces/produit';
import { IProduitRayon } from '../game/shared/interfaces/produitRayon';
import { IRayon } from '../game/shared/interfaces/rayon';

@Injectable({
  providedIn: 'root'
})
export class RayonService {


  private readonly MAGASIN_API_URL = "https://127.0.0.1:8000/api/magasin";

  constructor(private http: HttpClient) { }

  public getRayonByMagasin(id: Number): Observable<IRayon[]> {

    return this.http.get<IRayon[]>(this.MAGASIN_API_URL + "/"+ id +"/rayon").pipe(
      catchError(this.handleError)
    );
  }

  public getProduitByRayon(idRayon: Number): Observable<IProduitRayon[]> {

    return this.http.get<IProduitRayon[]>(this.MAGASIN_API_URL + "/"+ "33" +"/rayon/" + idRayon + "/produit").pipe(
      catchError(this.handleError)
    );
  }

  public getLeRayon(idRayon: Number): Observable<IRayon> {

    return this.http.get<IRayon>(this.MAGASIN_API_URL + "/"+ "x" +"/rayon/" + idRayon).pipe(
      catchError(this.handleError)
    );
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
