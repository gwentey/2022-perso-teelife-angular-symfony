import { HttpClientModule } from '@angular/common/http';
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';


import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AppFrontRoutingModule } from './front/front-routing.module';
import { FrontModule } from './front/front.module';
import { AppGameRoutingModule } from './game/game-routing.module';
import { GameModule } from './game/game.module';


@NgModule({
  declarations: [
    AppComponent
        ],
  imports: [
    FrontModule,
    BrowserModule,
    GameModule,
    AppFrontRoutingModule,
    AppGameRoutingModule,
    HttpClientModule,

    AppRoutingModule
    ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
