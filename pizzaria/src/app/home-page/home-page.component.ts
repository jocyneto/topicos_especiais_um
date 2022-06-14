import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
	selector: 'app-home-page',
	templateUrl: './home-page.component.html',
	styleUrls: ['./home-page.component.scss'],
	encapsulation: ViewEncapsulation.None
})
export class HomePageComponent implements OnInit {

	constructor(private http: HttpClient) {
	}

	get_usuario: any = localStorage.getItem('login');
	get_bebidas: any = []
	get_tamanho: any = []
	get_massa: any = []
	get_borda: any = []
	get_sabor: any = []
	get_pedidos: any = []
	get_pizzas: any = []

	ngOnInit(): void {
		this.http.get<any>('http://localhost/api/pedido/getall.php').subscribe(data => {
			console.log(data.result)
			this.get_pedidos = data.result
		})

		this.http.get<any>('http://localhost/api/bebida/getall.php').subscribe(data => {
			console.log(data.result)
			this.get_bebidas = data.result
		})

		this.http.get<any>('http://localhost/api/tamanho/getall.php').subscribe(data => {
			console.log(data.result)
			this.get_tamanho = data.result
		})

		this.http.get<any>('http://localhost/api/massa/getall.php').subscribe(data => {
			console.log(data.result)
			this.get_massa = data.result
		})

		this.http.get<any>('http://localhost/api/borda/getall.php').subscribe(data => {
			console.log(data.result)
			this.get_borda = data.result
		})

		this.http.get<any>('http://localhost/api/sabor/getall.php').subscribe(data => {
			console.log(data.result)
			this.get_sabor = data.result
		})
	}

	set_Bebida: any = 1
	set_Tamanho: any = 1
	set_Massa: any = 1
	set_Borda: any = 1
	set_Sabor: any = 1

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

	postData() {
		let pizza = { 'tamanho': this.set_Tamanho, 'massa': this.set_Massa, 'borda': this.set_Borda, 'sabor': this.set_Sabor }
		this.http.post<any>('http://localhost/api/pizza/insert.php', JSON.stringify(pizza)).subscribe(data => {
			let pedidos = { 'pizza': parseInt(data.result.pizza), 'status': 1, 'bebida': this.set_Bebida, 'usuario': this.get_usuario }
			this.http.post<any>('http://localhost/api/pedido/insert.php', JSON.stringify(pedidos)).subscribe(data => {
				console.log(data.result)
			})
		})
		//@ts-ignore
		document.getElementById('sabor').value = 5

		let msgPedido = document.getElementById("msg-pedido");
		if (!msgPedido) return;
		msgPedido.classList.remove("hidden");

		setInterval(() => {
			if (!msgPedido) return;
			msgPedido.innerHTML = '';
			msgPedido.classList.add("hidden");
		}, 3000)
	}
}
