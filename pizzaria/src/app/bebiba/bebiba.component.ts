import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
	selector: 'app-bebiba',
	templateUrl: './bebiba.component.html',
	styleUrls: ['./bebiba.component.scss']
})
export class BebibaComponent implements OnInit {

	constructor(private http: HttpClient) { }

	bebidas: any = []

	ngOnInit() {
		this.http.get<any>('http://localhost/api/bebida/getall.php').subscribe(data => {
			console.log(data.result)
			this.bebidas = data.result

			setTimeout(() => {
				let boxes = document.querySelectorAll<HTMLElement>('.box');

				boxes.forEach((box, index) => {
					box.style.backgroundImage = `url('../../${data.result[index].imagem}')`;
				})
			}, 0);
		})
	}

}
