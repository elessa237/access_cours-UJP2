import React, {useCallback, useEffect, useState} from 'react';
import useFetch from "../../Hooks/useFetch";
import axios from "axios";
import Spinner from "../../components/Spinner";

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
function GeneralSetting({id}) {

    const {postData, data: response, loading} = useFetch("/api/profil/settings/generalSetting");
    const [general, setGeneral] = useState({
        nom: "",
        prenom: "",
        tel: ""
    });
    const getInfo = useCallback(async (data) => {
        axios.post("/api/profil/generalSetting/items", data).then(response => {
            const UserInfo = response.data.response
            setGeneral({
                nom: UserInfo.nom,
                prenom: UserInfo.prenom,
                tel: UserInfo.tel
            })
        }).catch((error) => {
            console.error(error)
        })
    })

    function handleChange({currentTarget}) {
        const {name, value} = currentTarget
        setGeneral({...general, [name]: value})
    }

    function handleSubmit(event) {
        event.preventDefault()
        postData({
            id: id,
            nom: general.nom,
            prenom: general.prenom,
            tel: general.tel
        })
    }

    useEffect(() => {
        getInfo({id: id})
    }, [response])

    return (
        <div className="row mb-8">
            <div className="col-xl-3 col-lg-4 col-md-12 col-12">
                <div className="mb-4 mb-lg-0">
                    <h4 className="mb-1">Paramètre général</h4>
                    <p className="mb-0 fs-5 text-muted">Paramètre de configuration de profil </p>
                </div>
            </div>
            <div className="col-xl-9 col-lg-8 col-md-12 col-12">
                <div className="card">
                    <div className="card-body">
                        <div className=" mb-6">
                            <h4 className="mb-1">General Settings</h4>
                        </div>
                        <div className="row align-items-center mb-8">
                            <div className="col-md-3 mb-3 mb-md-0">
                                <h5 className="mb-0">Avatar</h5>
                            </div>
                            <div className="col-md-9">
                                <div className="d-flex align-items-center">
                                    <div className="me-3">
                                        <img src="/images/avatar/avatar-5.jpg"
                                             className="rounded-circle avatar avatar-lg" alt=""/>
                                    </div>
                                    <div>
                                        <button type="submit" className="btn btn-outline-white me-1">Change
                                        </button>
                                        <button type="submit" className="btn btn-outline-white">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div className="mb-6">
                                <h4 className="mb-1">Informations de base</h4>
                            </div>
                            <form onSubmit={handleSubmit}>
                                {loading ?
                                    <Spinner/> :
                                    <>
                                        <div className="mb-3 row">
                                            <label htmlFor="fullName" className="col-sm-4 col-form-label form-label">Nom
                                                complet</label>
                                            <div className="col-sm-4 mb-3 mb-lg-0">
                                                <input type="text" className="form-control" name="nom" placeholder="Nom"
                                                       id="fullName"
                                                       required onChange={handleChange}
                                                       value={general.nom}/>
                                            </div>
                                            <div className="col-sm-4">
                                                <input type="text" className="form-control" name="prenom"
                                                       placeholder="Prenom" id="lastName"
                                                       required onChange={handleChange}
                                                       value={general.prenom}/>
                                            </div>
                                        </div>
                                        <div className="mb-3 row">
                                            <label htmlFor="phone"
                                                   className="col-sm-4 col-form-label form-label">Tel <span
                                                className="text-muted">(Optional)</span></label>
                                            <div className="col-md-8 col-12">
                                                <input type="tel" className="form-control" name="tel"
                                                       placeholder="Numero telephone"
                                                       id="phone" required onChange={handleChange}
                                                       value={general.tel}/>
                                            </div>
                                        </div>
                                        <div className="offset-md-4 col-md-8 col-12 mt-4">
                                            <button type="submit" className="btn btn-primary">Modifier</button>
                                        </div>
                                    </>
                                }
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );

}

export default GeneralSetting;