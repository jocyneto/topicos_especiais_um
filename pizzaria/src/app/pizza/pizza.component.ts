import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-pizza',
	templateUrl: './pizza.component.html',
	styleUrls: ['./pizza.component.scss']
})
export class PizzaComponent implements OnInit {

	constructor(private http: HttpClient) { }

	pizza: any = []

	ngOnInit() {
		this.http.get<any>('http://localhost/api/sabor/getall.php').subscribe(data => {
			console.log(data.result)
			this.pizza = data.result

			setTimeout(() => {
				let boxes = document.querySelectorAll<HTMLElement>('.box');

				boxes.forEach((box, index) => {
					box.style.backgroundImage = `url('../../${data.result[index].imagem}')`;
				})
			}, 0);
		})

	}
}
