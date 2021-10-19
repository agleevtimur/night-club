import { Button } from "antd"
import React, { useState } from 'react';
import InfoWelcome from "./Info/InfoWelcome";
import InfoDJ from "./Info/InfoDJ";
import InfoAdmin from "./Info/InfoAdmin";
import { useStore } from "react-redux";


const modals = [<InfoWelcome />, <InfoAdmin />, <InfoDJ />];

const Start = () => {
  const [currentModalId, setCurrentModalId] = useState(-1);
  const store = useStore();

  const start = async () => {
      await fetch('http://127.0.0.1:8000/visitors?token=123123', { method: 'DELETE' });
      setCurrentModalId(0);
  }

  const nextModal = async (e) => {
    if (e.target.innerText === "Next") {
      setCurrentModalId(currentModalId + 1);
    }
    if (e.target.innerText === "Go!") {
      const data = store.getState();
      await fetch('http://127.0.0.1:8000/visitors?token=123123', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data.visitors)
      });
      localStorage.setItem('player', JSON.stringify(data.compositions));
      window.location = "/room";
    }
  }

  return (
    <>
      <div style={{ position: "absolute", top: "50%", left: "48%" }} onClick={start}>
        <Button size="large">Start</Button>
      </div>
      <div onClick={nextModal}>
        {modals.map((Component, index) => <Component.type visible={index === currentModalId} />)}
      </div>
    </>
  )
}

export default Start;