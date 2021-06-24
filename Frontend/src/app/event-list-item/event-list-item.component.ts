import { Component, Input, OnInit } from '@angular/core';
import { Event } from '../shared/event';
import {DatePipe} from '@angular/common';

@Component({
  selector: 'a.is-event-list-item',
  templateUrl: './event-list-item.component.html'
})
export class EventListItemComponent implements OnInit {
  @Input() event: Event;

  constructor(public datepipe:DatePipe) {}

  ngOnInit() {}
}
