import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from '../shared/authentication.service';
import { ImpfService } from '../shared/impf.service';
import { user_event_info } from '../shared/user-event-info';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  userInfo:user_event_info;
  constructor(
    public auth:AuthenticationService,
    public impf:ImpfService) { }

  ngOnInit() {
    if(!this.auth.isUserAdmin()){
    this.impf.getUserInfo().subscribe(res => {
      this.userInfo = res;
     });
    }
  }

}