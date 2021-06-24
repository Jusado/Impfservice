import {DatePipe} from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { EventFactory } from '../shared/event-factory';
import { ImpfService } from '../shared/impf.service';
import { EventFormErrorMessages } from './event-form-error-messages';
import { Event } from '../shared/event';
import { Location } from '../shared/location';

@Component({
  selector: 'app-event-form',
  templateUrl: './event-form.component.html',
  styleUrls: ['./event-form.component.css']
})
export class EventFormComponent implements OnInit {
  locations: Array<Location> = [];
  eventForm: FormGroup;
  time: String = '00:00';
  date: String = '00.00.0000';
  event = EventFactory.empty();
  isUpdatingEvent = false;
  errors: { [key: string]: string } = {};

  constructor(
    private fb: FormBuilder,
    private is: ImpfService,
    private route: ActivatedRoute,
    private router: Router,
    private datepipe: DatePipe
  ) {}

  ngOnInit() {
    const id = this.route.snapshot.params['id'];
    this.initEvent();

    if (id) {
      this.isUpdatingEvent = true;

      this.is.getAllLocations().subscribe(locations => {
        this.locations = locations;

        this.is.getSingle(id).subscribe(event => {
          this.event = EventFactory.fromObject(event);
          this.initEvent();
        });
      });
    } else {
      this.is.getAllLocations().subscribe(locations => {
        this.locations = locations;

        // Set sensible defaults
        this.event.location = this.locations[0];
        this.event.people = 10;

        this.initEvent();
      });
    }
  }

  impfLocationChanged(event) {
    let id = event.target.value;
    this.event.location = this.locations.find(x => x.id == id);
  }

  initEvent() {
    //Wir bauen das Formular Model
    this.eventForm = this.fb.group({
      id: this.event.id,
      appointment: [this.event.appointment],
      people: [this.event.people],
      locationId: [this.event?.location?.id || 0],
      dateTime: new FormControl(
          this.datepipe.transform(this.event.appointment, 'yyyy-MM-ddTHH:mm')
      )
    });
    this.eventForm.statusChanges.subscribe(() => {
      this.updateErrorMessages();
    });
  }

  updateErrorMessages() {
    this.errors = {};
    for (const message of EventFormErrorMessages) {
      const control = this.eventForm.get(message.forControl);
      if (
        control &&
        control.dirty &&
        control.invalid &&
        control.errors[message.forValidator] &&
        !this.errors[message.forControl]
      ) {
        this.errors[message.forControl] = message.text;
      }
    }
  }


  // braucht man für den Plus-Button -> hab ich noch nicht, bei 2:06:00 geht es hier weiter
  // addThumbnailControl(){}

  submitForm() {
    // Achtung hier wirklich die Namen überprüfen!
    const updatedEvent: Event = EventFactory.fromObject(this.eventForm.value);
    updatedEvent.location = this.event.location;
    updatedEvent.appointment = new Date(this.eventForm.get('dateTime').value);
    updatedEvent.locationId = updatedEvent.location.id;
    if (this.isUpdatingEvent) {
      this.is.update(updatedEvent).subscribe(
        res => {
          this.router.navigate(['../../events', updatedEvent.id], {
            relativeTo: this.route
          });
        },
        err => {
          // Hier sollte man sinnvolle Fehlermeldung über Toastmessage ausgeben
        }
      );
    } else {
      this.is.create(updatedEvent).subscribe(res => {
        this.router.navigate(['../events'], { relativeTo: this.route });
      });
    }
  }
}
