import { Modal, Button } from "antd";

const InfoWelcome = (props) => {
    return <Modal title="Welcome to night club!" visible={props.visible} footer={[<Button>Next</Button>]} closable={false}>
        <p>Unfortunately, all of our staff suddenly fell ill with the virus and we urgently need a replacement</p>
        <p>We missing DJ and admin...</p>
        <p>Can you do me a favour and handle these positions tonight?</p>
        <p>( You have no choice :] )</p>
    </Modal>
}

export default InfoWelcome;