const request = require("supertest")('http://localhost:8000/');

describe("GET /payroll", () => {
    it('respond with json containing a list of all leads type of payroll', done => {
        request
            .get('/payroll')
            .set('Accept', 'application/json')
            .expect('Content-Type', /json/)
            .expect(200, done);
    });
});

describe("POST /payroll", () => {
    it('respond with 201 when lead payroll is created', done => {
        const data = {
            name: 'Client Test',
            phone: '1234567890',
            email: 'email@test.com',
            rfc: 'RFCH123456AB',
            address: 'Test address',
            zipcode: '12345',
            city: 'City',
            state: 'State',
            company: 'Empresa',
            date_admission: '2021-11-15'
        }
        request
            .post('/payroll')
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