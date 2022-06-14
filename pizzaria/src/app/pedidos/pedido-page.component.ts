import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';

@Component({
	selector: 'app-pedido-page',
	templateUrl: './pedido-page.component.html',
	styleUrls: ['pedido-page.component.scss'],
	encapsulation: ViewEncapsulation.None
})
export class PedidoPageComponent implements OnInit {

	constructor(private http: HttpClient) {
	}
	get_bebidas: any = []
	get_tamanho: any = []
	get_massa: any = []
	get_borda: any = []
	get_sabor: any = []
	get_pedidos: any = []
	get_pizzas: any = []

	ngOnInit(): void {

		this.http.get<any>('http://localhost/api/pedido/getall.php').subscribe(data => {
			this.get_pedidos = data.result
		})

		this.http.get<any>('http://localhost/api/bebida/getall.php').subscribe(data => {
			this.get_bebidas = data.result
		})

		this.http.get<any>('http://localhost/api/tamanho/getall.php').subscribe(data => {
			this.get_tamanho = data.result
		})

		this.http.get<any>('http://localhost/api/massa/getall.php').subscribe(data => {
			this.get_massa = data.result
		})

		this.http.get<any>('http://localhost/api/borda/getall.php').subscribe(data => {
			this.get_borda = data.result
		})

		this.http.get<any>('http://localhost/api/sabor/getall.php').subscribe(data => {
			this.get_sabor = data.result
		})
	}


	set_Usuario: any = localStorage.getItem('login');
	set_Bebida: any = 1
	set_Tamanho: any = 1
	set_Massa: any = 1
	set_Borda: any = 1
	set_Sabor: any = 1

	set_Bebida_edit: any
	set_Tamanho_edit: any
	set_Massa_edit: any
	set_Borda_edit: any
	set_Sabor_edit: any

	setBebida() {
		//@ts-ignore
		this.set_Bebida = document.getElementById('bebida').value
		console.log(this.set_Bebida)
	}
	setTamanho() {
		//@ts-ignore
		this.set_Tamanho = document.getElementById('tamanho').value
		console.log(this.set_Tamanho)
	}
	setMassa() {
		//@ts-ignore
		this.set_Massa = document.getElementById('massa').value
		console.log(this.set_Massa)
	}
	setBorda() {
		//@ts-ignore
		this.set_Borda = document.getElementById('borda').value
		console.log(this.set_Borda)
	}
	setSabor() {
		//@ts-ignore
		this.set_Sabor = document.getElementById('sabor').value
		console.log(this.set_Sabor)
	}

	//EDITAR
	setBebida_edit() {
		//@ts-ignore
		this.set_Bebida_edit = document.getElementById('bebida').value
		console.log(this.set_Bebida)
	}
	setTamanho_edit() {
		//@ts-ignore
		this.set_Tamanho_edit = document.getElementById('tamanho').value
		console.log(this.set_Tamanho)
	}
	setMassa_edit() {
		//@ts-ignore
		this.set_Massa_edit = document.getElementById('massa').value
		console.log(this.set_Massa)
	}
	setBorda_edit() {
		//@ts-ignore
		this.set_Borda_edit = document.getElementById('borda').value
		console.log(this.set_Borda)
	}
	setSabor_edit() {
		//@ts-ignore
		this.set_Sabor_edit = document.getElementById('sabor').value
		console.log(this.set_Sabor)
	}
	getPedido() {

	}
	pedido: any
	pizza: any
	editData(bebida: any, pedido: any, pizza: any) {
		this.pedido = pedido
		this.pizza = pizza
		const params = new HttpParams().append('pizza', this.pizza);
		console.log(this.pizza)
		this.http.get<any>(`http://localhost/api/pedido/get.php?pedido=${this.pedido}`).subscribe(data => {
			this.http.get<any>(`http://localhost/api/pizza/get.php?pizza=${data.result.pizza}`).subscribe(data2 => {
				//@ts-ignore
				document.getElementById('bebida').value = data.result.bebida
				//@ts-ignore
				document.getElementById('tamanho').value = data2.result.tamanho
				//@ts-ignore
				document.getElementById('massa').value = data2.result.massa
				//@ts-ignore
				document.getElementById('borda').value = data2.result.borda
				//@ts-ignore
				document.getElementById('sabor').value = data2.result.sabor

			})
		})
	}

	tamanho: any
	postData() {
		let pedido = { 'pedido': this.pedido, 'status': 1, 'bebida': this.set_Bebida }
		let pizza = { 'pizza': this.pizza, 'tamanho': this.tamanho, 'massa': this.set_Massa, 'borda': this.set_Borda, 'sabor': this.set_Sabor, 'pedido': this.pedido }
		this.http.put<any>('http://localhost/api/pedido/update.php', JSON.stringify(pedido)).subscribe(data => {
			this.http.put<any>('http://localhost/api/pizza/update.php', JSON.stringify(pizza)).subscribe(data => {
				console.log(data)
			})
		})

		setInterval(() => {
			document.location.reload();
		}, 1500)
	}

	deleteData(pedido: any, pizza: any) {
		this.http.put<any>('http://localhost/api/pedido/delete.php', JSON.stringify({ "pedido": pedido })).subscribe(data => {
			console.log(data)
		})

		confirm('Tem certeza que deseja deletar esse pedido?');
		
		document.location.reload();

	}
}
