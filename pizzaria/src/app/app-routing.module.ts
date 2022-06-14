import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HeroDetailComponent } from '../app/hero-detail/hero-detail.component';
import { CardapioComponent } from '../app/cardapio/cardapio.component';
import { BebibaComponent } from '../app/bebiba/bebiba.component';
import { PizzaComponent } from '../app/pizza/pizza.component';
import { HomePageComponent } from './home-page/home-page.component';
import { PedidoPageComponent } from './pedidos/pedido-page.component';
import { LocalizacaoComponent } from './localizacao/localizacao.component';
import { HistoriaComponent } from './historia/historia.component';

const routes: Routes = [
  { path: '', component: HeroDetailComponent },
  { path: 'cardapio', component: CardapioComponent },
  { path: 'bebida', component: BebibaComponent },
  { path: 'home-page', component: HomePageComponent },
  { path: 'pizza', component: PizzaComponent },
  { path: 'pedidos', component: PedidoPageComponent },
  { path: 'localizacao', component: LocalizacaoComponent },
  { path: 'historia', component: HistoriaComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
