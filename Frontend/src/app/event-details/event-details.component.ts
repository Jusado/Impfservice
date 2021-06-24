import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Event } from '../shared/event';
import { ImpfService } from '../shared/impf.service';
import { DatePipe } from '@angular/common';
import { ToastrService } from 'ngx-toastr';
import { AuthenticationService } from '../shared/authentication.service';
import { user_event_info } from '../shared/user-event-info';

@Component({
  selector: 'is-event-details',
  templateUrl: './event-details.component.html'
})
export class EventDetailsComponent implements OnInit {
  @Input() event: Event;

  private id: number;
  userInfo:user_event_info;

  constructor(
    private is: ImpfService,
    private route: ActivatedRoute,
    public datepipe: DatePipe,
    private router: Router,
    private toastr: ToastrService,
    public authService: AuthenticationService
  ) {}

  ngOnInit() {
    const params = this.route.snapshot.params;
    this.id = Number(params['id']);
    this.is.getSingle(this.id).subscribe(event => {
      this.event = event;
      console.log(event);
    });
    if(!this.authService.isUserAdmin()){
      this.is.getUserInfo().subscribe(res => {
        this.userInfo = res;
       });
      }
  }

  bookEvent() {
    this.is.bookEvent(this.id).subscribe(result => {
      window.location.reload();
    });
  }

  userVacinateSet(event, userId) {
    this.is.setUserVac(userId).subscribe(event => {
      window.location.reload();
    });
  }

  deleteEvent() {
    if (confirm('Wollen Sie diesen Impftermin wirklich löschen?')) {
      //asynchron -> Inhalt von Subcribe wird erst ausgeführt, wenn REST call fertig ist
      // Bei jedem asynchronen Aufruf wird eine function/ error function mitgegeben!
      this.is.delete(this.event.id).subscribe(res => {
        this.toastr.success('Der Impftermin wurde erfolgreich gelöscht');
        this.router.navigate(['../'], { relativeTo: this.route });
      });
    }
  }

  isLoggedIn() {
    return this.authService.isLoggedIn();
  }

  isAdmin() {
    return this.authService.isUserAdmin();
  }
}
