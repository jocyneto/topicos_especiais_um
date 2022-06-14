import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { Router } from "@angular/router"

@Component({
	selector: 'app-hero-detail',
	templateUrl: './hero-detail.component.html',
	styleUrls: ['./hero-detail.component.scss']
})
export class HeroDetailComponent implements OnInit {

	constructor(private http: HttpClient, private router: Router) { }

	ngOnInit(): void {
	}

	login() {
		//@ts-ignore
		let user = document.getElementById('user').value
		//@ts-ignore
		let password = document.getElementById('pass').value
		let pedido = { 'email': user, 'senha': password }
		this.http.post<any>('http://localhost/api/usuario/get.php', JSON.stringify(pedido)).subscribe(data => {
			if (data.result.email == user) {
				this.router.navigate(['/home-page'])
			}

			localStorage.setItem('login', data.result.usuario);

			console.log(data)

			let msgLogin = document.getElementById("msg-login");
			if (!msgLogin) return;

			if (data.error) {
				msgLogin.classList.add("error")
				msgLogin.innerHTML = data.error;
			}

			setInterval(() => {
				if (!msgLogin) return;
				msgLogin.innerHTML = '';
				msgLogin.classList.remove("error")
			}, 3000)

		})
	}
}
