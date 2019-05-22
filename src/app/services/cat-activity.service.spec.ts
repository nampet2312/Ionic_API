import { TestBed } from '@angular/core/testing';

import { CatActivityService } from './cat-activity.service';

describe('CatActivityService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: CatActivityService = TestBed.get(CatActivityService);
    expect(service).toBeTruthy();
  });
});
