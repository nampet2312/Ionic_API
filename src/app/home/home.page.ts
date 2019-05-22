import { Component } from '@angular/core';
import {CatActivityService} from '../services/cat-activity.service';
//import {Subscription} from 'rxjs/Subscription';
import { Subscription } from 'rxjs';
import {Router} from '@angular/router';




@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss']

})
export class HomePage {

  subscription : Subscription;
  dataList : any = [];
  dataRow = 0;
 

  constructor(private catActSV : CatActivityService ,private route:Router){
    this.showData();

  }
  showData(){ //
    this.subscription=this.catActSV.getCatActvity()
    .subscribe(
      data =>{
        //console.log("data:"+ data['rs'].length);
        this.dataList = data['rs'];
      }
    )
  }
  
  Add(){
    this.route.navigateByUrl("add");
  }

  edit(id) { 
    this.route.navigate(['/edit',{id : id}]);
  }

  Delete(id) {
    
    this.catActSV.del(id).subscribe(
       );
       this.showData();
  }
  /*ngAfterViewInit(){
    this.showData();
  }*/
  
}
