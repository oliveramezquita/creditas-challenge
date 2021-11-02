const request = require("supertest")('http://127.0.0.1:8000/');

describe("GET /car", () => {
    it('respond with json containing a list of all leads type of car', done => {
        request
            .get('/car')
            .set('Accept', 'application/json')
            .expect('Content-Type', /json/)
            .expect(200, done);
    });
});

describe("POST /car", () => {
    it('respond with 201 when lead car is created', done => {
        const data = {
            name: 'Client Test',
            phone: '1234567890',
            email: 'email@test.com',
            rfc: 'RFCH123456AB',
            address: 'Test address',
            zipcode: '12345',
            city: 'City',
            state: 'State',
            model: 'Model car test',
            price: '123456'
        }
        request
            .post('/car')
            .send(data)
            .set('Accept', 'application/json')
            .set('Content-Type', 'application/x-www-form-urlencoded')
            .expect('Content-Type', /json/)
            .expect(201)
            .end(err => {
                if (err) return done(err);
                done();
            })
    });
});