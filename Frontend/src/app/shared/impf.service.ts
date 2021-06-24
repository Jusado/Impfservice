import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, pipe, throwError } from 'rxjs';
import { catchError, retry } from 'rxjs/operators';
import { Event, Location } from './event';
import { user_event_info } from './user-event-info';

@Injectable()
export class ImpfService {
  private api = 'https://impfservice21.s1810456008.student.kwmhgb.at/api';

  constructor(private http: HttpClient) {}

  getAllLocations(): Observable<Array<Location>> {
    return this.http
      .get<Array<Location>>(`${this.api}/locations`)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

  getAll(): Observable<Array<Event>> {
    return this.http
      .get<Array<Event>>(`${this.api}/events/enumeration`)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

  getFree(): Observable<Array<Event>> {
    return this.http
      .get<Array<Event>>(`${this.api}/events/enumerationFreeDates`)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

  getSingle(id: number): Observable<Event> {
    return this.http
      .get<Event>(`${this.api}/events/byId/${id}`)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

  getUserInfo(): Observable<user_event_info> {
    return this.http
      .get<user_event_info>(`${this.api}/events/info`)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

  //delte Event
  delete(id: Number): Observable<any> {
    return this.http
      .delete(`${this.api}/events/delete/${id}`)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

  //create new Event
  create(event: Event): Observable<any> {
    return this.http
      .post(`${this.api}/events/create`, event)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

  //update event
  update(event: Event): Observable<any> {
    return this.http
      .put(`${this.api}/events/update/${event.id}`, event)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

  setUserVac(id: number): Observable<any> {
    alert('Der Impfstatus wurde erfolgreich geändert!');
    return this.http
      .post(`${this.api}/events/setVac/` + id, {})
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

  bookEvent(eventId: number): Observable<any> {
    return this.http
      .post(`${this.api}/events/book/${eventId}`, {})
      .pipe(catchError(this.errorHandler));
  }

  private errorHandler(error: Error | any) {
    console.log(error);
    return throwError(error);
  }
}
