import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';


@Injectable({
  providedIn: 'root'
})
export class CatActivityService {
  apiUrl: string ="http://localhost/Information/process/crud_cateactivity.php";
  constructor(public http: HttpClient) { }

  getCatActvity(){
    const header = {'Content-Type': 'application/json'};
    let data = {
      'cmd' : 'select'//เก็บค่า select  ไปยังตัวแปร cmd
    }
    return this.http.post(this.apiUrl,data, {headers: header});//รีเทินค่า
  }

  get(id : any){
    const header = {'Content-Type': 'application/json'};
    let data = {
      'cmd' : 'selectone',
      'id' : id
    }
    return this.http.post(this.apiUrl,data, {headers: header});
  }
  
  insert( name: string, lname: string, gender: string){
    const header = { 'Content-Type': 'application/json' };
    let data = {
      'cmd' : 'insert',
      'name': name,
      'lname': lname,
      'gender': gender
    }
    return this.http.post(this.apiUrl, data, { headers: header });
  }

  del( id : any){
    const header = { 'Content-Type': 'application/json' };
    let data = {
      'cmd' : 'delete',
      'id' : id
    }
    return this.http.post(this.apiUrl, data, { headers: header });
  }


  edit( id: any , name: string, lname: string, gender: string){
    const header = { 'Content-Type': 'application/json' };
    let data = {
      'cmd' : 'edit',
      'id' : id ,
      'name': name,
      'lname': lname,
      'gender': gender
    }
    return this.http.post(this.apiUrl, data, { headers: header });
  }
}
