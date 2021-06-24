import { Event } from './event';
export class EventFactory {
  static empty(): Event {
    return new Event(null, new Date(), new Date(), null, null, null,[]);
  }

  static fromObject(rawEvent: any): Event {
    return new Event(
      rawEvent.id,
      typeof(rawEvent.date) === 'string' ? new Date (rawEvent.date) : rawEvent.date,
      typeof(rawEvent.appointment) === 'string' ? new Date (rawEvent.appointment) : rawEvent.appointment,
      rawEvent.current_amount,
      rawEvent.location,
      rawEvent.people,
      rawEvent.user
    );
  }
}
