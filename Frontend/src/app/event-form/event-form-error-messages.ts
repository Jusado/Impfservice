export class ErrorMessage {
  constructor(
    public forControl: string,
    public forValidator: string,
    public text: string
  ) { }
 }

 export const EventFormErrorMessages = [
  new ErrorMessage('date', 'required', 'Ein Datum muss angegeben werden'),
  new ErrorMessage('appointment', 'required', 'Es muss eine Uhrzeit angegeben werden'),
  new ErrorMessage('location', 'required', 'Es muss eine Adresse angegeben werden')
 ];