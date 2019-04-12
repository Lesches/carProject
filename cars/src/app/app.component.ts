import { Component, OnInit } from '@angular/core';

import { Car } from './car';
import { CarService } from './car.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  cars: Car[];
  error = '';
  success = '';
  car = new Car('', 0);

  constructor(private carService: CarService) {
  }

  ngOnInit() {
    this.getCars();
  }

  getCars(): void {
    this.carService.getAll().subscribe(
      (res: Car[]) => {
        this.cars = res;
      },
      (err) => {
        this.error = err;
      }
    );
  }

  addCar(f) {
    this.error = '';
    this.success = '';

    this.carService.store(this.car).subscribe((res: Car[]) => {
      // update the list of cars
      this.cars = res;

      // inform user
      this.success = 'created successfully';

      // reset the form
      f.reset();
    },
    (err) => this.error = err
  );
  }

  updateCar(name, price, id) {
    this.error = '';
    this.success = '';

    this.carService.update({model: name.value, price: price.value, id: +id}).subscribe((res) => {
        // update the list of cars
        this.cars = res;

        // inform user
        this.success = 'updated successfully';


      },
      (err) => this.error = err
    );
  }

  deleteCar(id) {
    this.error = '';
    this.success = '';

    this.carService.delete(+id).subscribe((res: Car[]) => {

        this.cars = res;

        // inform user
        this.success = 'Deleted successfully';


      },
      (err) => this.error = err
    );
  }
}
