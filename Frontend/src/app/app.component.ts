import { Component, VERSION } from '@angular/core';
import { AuthenticationService } from './shared/authentication.service';
import { Event } from './shared/event';

@Component({
  selector: 'is-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
 constructor(private authService:AuthenticationService){}

 isLoggedIn(){
   return this.authService.isLoggedIn();
 }

 isAdmin() {
   return this.authService.isUserAdmin();
 }

 getLoginLabel(){
   if(this.isLoggedIn()){
     return "Logout";
   }else{
     return "Login";
   }
  }
 

}
