import { Component, OnInit } from '@angular/core';
import {CatActivityService} from '../services/cat-activity.service';
//import {Subscription} from 'rxjs/Subscription';
import { Subscription } from 'rxjs';
import {Router , ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-edit',
  templateUrl: './edit.page.html',
  styleUrls: ['./edit.page.scss'],
})
export class EditPage implements OnInit {

  subscription : Subscription;
  dataList : any = [];
  dataRow = 0;
  id : string;

  constructor(private catActSV : CatActivityService ,private route:Router,private router: ActivatedRoute) {
    this.showData(); 
  }
  showData(){
    let id = this.id = (this.router.snapshot.paramMap.get('id'));
    this.subscription=this.catActSV.get(id)
    .subscribe(
      data =>{
        this.dataList = data['rs'];
      }
    )
  }

  edit(form) {
    let id = this.id = (this.router.snapshot.paramMap.get('id'));
    let name = form.name;
    let lname = form.lname;
    let gender = form.gender;
    
    this.catActSV.edit(id , name, lname, gender).subscribe(
      
       );
       this.route.navigateByUrl("home");
      
       
  }

  ngOnInit() {
  }

}
