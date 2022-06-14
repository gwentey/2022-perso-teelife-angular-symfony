import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { catchError, Observable, tap, throwError } from 'rxjs';
import { IPanier } from '../game/shared/interfaces/panier';


@Injectable({
  providedIn: 'root'
})
export class PanierService {

  private readonly PANIER_API_URL = "https://127.0.0.1:8000/api/panier";
  public panier: any;
  public produit: any;

  constructor(private http: HttpClient) { }

  public getCurrentPanier(idMagasin: Number, idPersonnage: Number): Observable<IPanier> {

    return this.http.get<IPanier>(this.PANIER_API_URL + "/" + idMagasin + "/" + idPersonnage).pipe(
      tap(paniers => console.log('paniers:', paniers)),
      catchError(this.handleError)
    );

  }

  // crée un panier
  public creePanier(idMagasin: Number, idPersonnage: Number): Observable<IPanier> {

    this.panier = {
      id_magasin: idMagasin,
      id_personnage: idPersonnage,
      payer: false,
    }

    return this.http.post<any>(this.PANIER_API_URL + "/", this.panier).pipe(
      catchError(this.handleError)
    );

  }

  // ajouter un produit a un rayon
  public ajouterUnProduitDansUnPanier(idPanier: Number, setIdProduitRayon: Number, quantite: Number): Observable<IPanier> {

    this.produit = {
      id_panier: idPanier,
      id_produit_rayon: setIdProduitRayon,
      quantite: quantite,
    }

    console.log(this.produit);

    return this.http.post<any>(this.PANIER_API_URL + "/addproduct/", this.produit).pipe(
      catchError(this.handleError)
    );

  }

  // faire payer un panier
  public signalerPanierPayer(idPanier: Number): Observable<any> {

    const situation = {
      id_panier: idPanier
    }

    return this.http.put<any>(this.PANIER_API_URL + "/", situation).pipe(
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
