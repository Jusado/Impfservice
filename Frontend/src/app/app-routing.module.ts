import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { EventDetailsComponent } from './event-details/event-details.component';
import { EventFormComponent } from './event-form/event-form.component';
import { EventListComponent } from './event-list/event-list.component';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';

const routes: Routes = [
  {path:'', redirectTo:'home', pathMatch:"full"},
  {path:'home', component: HomeComponent},
  {path:'events', component:EventListComponent},
  {path:'events/:id', component:EventDetailsComponent},
  {path:'admin', component:EventFormComponent},
  {path:'admin/:id', component:EventFormComponent},
  {path:'login', component:LoginComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }