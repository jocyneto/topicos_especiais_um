import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeroDetailComponent } from './hero-detail/hero-detail.component';
import { CardapioComponent } from './cardapio/cardapio.component';
import { BebibaComponent } from './bebiba/bebiba.component';
import { PizzaComponent } from './pizza/pizza.component';
import { HomePageComponent } from './home-page/home-page.component';
import {MatFormFieldModule} from '@angular/material/form-field';
import {MatSelectModule} from '@angular/material/select';
import { FormsModule } from '@angular/forms';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {MatCardModule} from '@angular/material/card';
import { PedidoPageComponent } from './pedidos/pedido-page.component';
import { LocalizacaoComponent } from './localizacao/localizacao.component';
import { HistoriaComponent } from './historia/historia.component';
import {MatButtonModule} from '@angular/material/button';
import {MatIconModule} from '@angular/material/icon';

@NgModule({
  declarations: [
    AppComponent,
    HeroDetailComponent,
    CardapioComponent,
    BebibaComponent,
    PizzaComponent,
    HomePageComponent,
    PedidoPageComponent,
    LocalizacaoComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    MatFormFieldModule,
    MatSelectModule,
    FormsModule,
    BrowserAnimationsModule,
    MatSelectModule,
    MatCardModule,
    MatButtonModule,
    MatIconModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
