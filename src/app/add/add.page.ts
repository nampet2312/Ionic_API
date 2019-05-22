import { Component, OnInit } from '@angular/core';
import {CatActivityService} from '../services/cat-activity.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-add',
  templateUrl: './add.page.html',
  styleUrls: ['./add.page.scss'],
})
export class AddPage implements OnInit {

  constructor(private catActSV : CatActivityService ,private route:Router){
    

  }

  ngOnInit() {
  }

  insert(form) {
    let name = form.name;
    let lname = form.lname;
    let gender = form.gender;
    
    this.catActSV.insert(name, lname,gender).subscribe(
      
       );
       this.route.navigateByUrl("home");
       
  }
}
