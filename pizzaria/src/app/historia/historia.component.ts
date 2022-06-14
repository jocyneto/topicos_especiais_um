import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'app-historia',
	templateUrl: './historia.component.html',
	styleUrls: ['./historia.component.scss']
})
export class HistoriaComponent implements OnInit {

	constructor(private http: HttpClient) { }

	ngOnInit(): void {

	}

}
