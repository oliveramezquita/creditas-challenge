const request = require("supertest")('http://localhost:8000/');

describe("GET /client/:client_id", () => {
    it('respond with json containing a single client', done => {
        request
            .get('/client/1')
            .set('Accept', 'application/json')
            .expect('Content-Type', /json/)
            .expect(200, done);
    });
});