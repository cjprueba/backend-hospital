import React, { useEffect, useState } from 'react';
import userServices from "../../services/User"

function Register(){

  const [ name, setName ] = useState(null);
  const [ cpf, setCPF ] = useState(null);
  const [ address, setAddress ] = useState(null);
  const [ email, setEmail ] = useState(null);
  const [ password, setPassword ] = useState(null);
  const [ phone, setPhone ] = useState(null);
  const [ gender, setGender ] = useState(null);
  const [ age, setAge ] = useState(null);
  const [ listRol, setListRol ] = useState([]);
  const [ crm, setCRM ] = useState(null);
  const [ type, setType ] = useState(null);

  useEffect(() => {

      async function fetchDataRol(){
        const res = await userServices.list();
        setListRol(res.data);
      }

      fetchDataRol();

  }, []);

  const saveUser = async () => {

    const data = {
      name, cpf, address, email, password, phone, gender, age, crm, type
    }

    const res = await userServices.save(data);

    if (res.success) {
      alert(res.message);
    } else {
      alert(res.message);
    }

  }

  return(
    <div className="container">
      <div className="row">
        <div className="col-md-6 mb-3">
          <label htmlFor="firstName">Nombre</label>
          <input type="text" onChange={(event)=>setName(event.target.value)} className="form-control" placeholder="Nombre" />
        </div>
      
        <div className="col-md-6 mb-3">
          <label htmlFor="email">CPF</label>
          <input type="email" onChange={(event)=>setCPF(event.target.value)} className="form-control" placeholder="000-000-000.00" />
        </div>
      

      
        <div className="col-md-6 mb-3">
          <label htmlFor="address">Dirección</label>
          <input type="text" onChange={(event)=>setAddress(event.target.value)} className="form-control" placeholder="1234 Av. Paraná" />
        </div>
      

      
        <div className="col-md-6 mb-3">
          <label htmlFor="phone">Correo </label>
          <input type="email" onChange={(event)=>setEmail(event.target.value)} className="form-control" placeholder="ejemplo@hotmail.com" />
        </div>

        
        <div className="col-md-6 mb-3">
          <label htmlFor="phone">Contraseña</label>
          <input type="password" onChange={(event)=>setPassword(event.target.value)} className="form-control"/>
        </div>

      
        <div className="col-md-6 mb-3">
					<label htmlFor="phone">Telefono </label>
					<input type="text" onChange={(event)=>setPhone(event.target.value)} className="form-control" placeholder="123467890" />
        </div>
      

      
        <div className="col-md-6 mb-3">
          <label htmlFor="phone">Sexo </label>
          <select id="inputState" className="form-control" onChange={(event)=>setGender(event.target.value)}>
             <option defaultValue>Seleccionar...</option>
             <option value="1">M</option>
             <option value="2">F</option>
          </select>
        </div>
      
      
        <div className="col-md-6 mb-3">
          <label htmlFor="phone">Edad </label>
          <input type="text" onChange={(event)=>setAge(event.target.value)} className="form-control" placeholder="20" />
        </div>
      

      
        <div className="col-md-6 mb-3">
          <label htmlFor="phone">Tipo {type} </label>
          <select id="inputState" className="form-control" onChange={(event)=>setType(event.target.value)}>
             <option defaultValue>Seleccionar...</option>
             
             {
               listRol.map((item)=>{
                 return(
                   <option key={item.id} value={item.id}>{item.name}</option>
                 )
               })
             }

          </select>
        </div>
      

        {type == 1 &&       
          <div className="col-md-6 mb-3">
            <label htmlFor="phone">Nro. CRM </label>
            <input type="text" onChange={(event)=>setCRM(event.target.value)} className="form-control" placeholder="123467890" />
          </div>
        }

      </div>
      <div className="row">
        <div className="offset-6 col-md-6 mb-3">
          <button className="btn btn-primary btn-block" onClick={() => saveUser()} type="submit">Guardar</button>
        </div>
      </div>
    </div>
  )
}

export default Register;