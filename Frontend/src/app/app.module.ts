import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { HelloComponent } from './hello.component';
import { EventListComponent } from './event-list/event-list.component';
import { EventListItemComponent } from './event-list-item/event-list-item.component';
import { EventDetailsComponent } from './event-details/event-details.component';
import { ImpfService } from './shared/impf.service';
import { HomeComponent } from './home/home.component';
import { AppRoutingModule } from './app-routing.module';
import { DatePipe } from '@angular/common';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ToastrModule } from 'ngx-toastr';
import { EventFormComponent } from './event-form/event-form.component';
import { LoginComponent } from './login/login.component';
import { AuthenticationService } from './shared/authentication.service';
import { TokenInterceptor } from './shared/token-interceptor.service';

@NgModule({
  imports: [
    BrowserModule,
    ReactiveFormsModule,
    AppRoutingModule,
    HttpClientModule,
    BrowserAnimationsModule,
    ToastrModule.forRoot()
  ],
  declarations: [
    AppComponent,
    EventListComponent,
    EventListItemComponent,
    EventDetailsComponent,
    HomeComponent,
    EventFormComponent,
    LoginComponent
  ],
  bootstrap: [AppComponent],
  providers: [
    ImpfService,
    DatePipe,
    AuthenticationService,
    {
      provide: HTTP_INTERCEPTORS,
      useClass: TokenInterceptor,
      multi: true
      }
  ]
})
export class AppModule {}
