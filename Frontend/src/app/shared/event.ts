import { Location } from './location';
export { Location } from './location';
import { User } from './user';

export class Event {
  constructor(
    public id: number,
    public date: Date,
    public appointment: Date,
    public current_amount: number,
    public location: Location,
    public people: number,
    public user: User[],
    public locationId: number = 1
  ) {}
}
