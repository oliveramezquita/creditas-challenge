const request = require("supertest")('http://localhost:8000/');

describe("GET /house", () => {
    it('respond with json containing a list of all leads type of house', done => {
        request
            .get('/house')
            .set('Accept', 'application/json')
            .expect('Content-Type', /json/)
            .expect(200, done);
    });
});

describe("POST /house", () => {
    it('respond with 201 when lead house is created', done => {
        const data = {
            name: 'Client Test',
            phone: 1234567890,
            email: 'email@test.com',
            rfc: 'RFCH123456AB',
            address: 'Test address',
            zipcode: 12345,
            city: 'City',
            state: 'State',
            value: '1000000',
            ug_address: 'Dirección de casa en garantía',
            ug_zipcode: 12345,
            ug_city: 'City casa en garantía',
            ug_state: 'State casa en garantía'
        }
        request
            .post('/house')
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