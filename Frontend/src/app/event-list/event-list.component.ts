import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { AuthenticationService } from '../shared/authentication.service';
import { Event, Location } from '../shared/event';
import { ImpfService } from '../shared/impf.service';


@Component({
  selector: 'is-event-list',
  templateUrl: './event-list.component.html'
})
export class EventListComponent implements OnInit {
  events: Array<Event> = new Array<Event>();

  @Output() showDetailsEvent = new EventEmitter<Event>();

  constructor(private is:ImpfService,
    private authService:AuthenticationService) {
  }

  showDetails(event: Event) {
    this.showDetailsEvent.emit(event);
  }

  ngOnInit() {
    if(this.authService.isUserAdmin()){
      this.is.getAll().subscribe(res => {
        this.events = res as Event[];
        console.log(JSON.stringify(this.events)); 
       });
    }else{
      this.is.getFree().subscribe(res => {
      this.events = res as Event[];
      console.log(JSON.stringify(this.events)); 
      });
  }
  }
}
