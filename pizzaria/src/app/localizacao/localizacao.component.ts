import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-localizacao',
	templateUrl: './localizacao.component.html',
	styleUrls: ['./localizacao.component.scss']
})
export class LocalizacaoComponent implements OnInit {

	constructor(private http: HttpClient) { }

	ngOnInit(): void {

	}

}
