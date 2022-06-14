import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { catchError, Observable, tap, throwError } from 'rxjs';
import { IMagasin } from '../game/shared/interfaces/magasin';

@Injectable({
  providedIn: 'root'
})
export class MagasinService {

  private readonly MAGASIN_API_URL = "https://127.0.0.1:8000/api/magasin";

  constructor(private http: HttpClient) { }

  public getMagasin(): Observable<IMagasin[]> {

    return this.http.get<IMagasin[]>(this.MAGASIN_API_URL).pipe(
      tap(magasins => console.log('magasins:', magasins)),
      catchError(this.handleError)
    );

  }

  public getOneMagasin(id: Number): Observable<IMagasin> {

    return this.http.get<IMagasin>(this.MAGASIN_API_URL + "/" + id).pipe(
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
