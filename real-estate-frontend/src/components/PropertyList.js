import React, { useState, useEffect } from 'react';
import {
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    Paper,
    Button,
    Dialog,
    DialogTitle,
    DialogContent,
    Box,
} from '@mui/material';
import PropertyForm from './PropertyForm';
import { getProperties, deleteProperty, updateProperty, createProperty } from '../services/api';

export default function PropertyList() {
    const [properties, setProperties] = useState([]);
    const [open, setOpen] = useState(false);
    const [selectedProperty, setSelectedProperty] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchProperties();
    }, []);

    const fetchProperties = async () => {
        try {
            const response = await getProperties();
            setProperties(response.data.data);
        } catch (error) {
            console.error('Error fetching properties:', error);
        } finally {
            setLoading(false);
        }
    };

    const handleDelete = async (id) => {
        if (window.confirm('Are you sure you want to delete this property?')) {
            try {
                await deleteProperty(id);
                fetchProperties();
            } catch (error) {
                console.error('Error deleting property:', error);
            }
        }
    };

    const handleEdit = (property) => {
        setSelectedProperty(property);
        setOpen(true);
    };

    const handleCreate = () => {
        setSelectedProperty(null);
        setOpen(true);
    };

    const handleFormSubmit = async (formData) => {
        try {
            if (selectedProperty) {
                await updateProperty(selectedProperty.id, formData);
            } else {
                await createProperty(formData);
            }
            setOpen(false);
            fetchProperties();
        } catch (error) {
            console.error('Error saving property:', error);
        }
    };

    if (loading) {
        return <div>Loading...</div>;
    }

    return (
        <Box sx={{ p: 3 }}>
            <Button
                variant="contained"
                color="primary"
                onClick={handleCreate}
                sx={{ mb: 3 }}
            >
                Add New Property
            </Button>

            <TableContainer component={Paper}>
                <Table>
                    <TableHead>
                        <TableRow>
                            <TableCell>Name</TableCell>
                            <TableCell>Type</TableCell>
                            <TableCell>City</TableCell>
                            <TableCell>Country</TableCell>
                            <TableCell>Actions</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {properties.map((property) => (
                            <TableRow key={property.id}>
                                <TableCell>{property.name}</TableCell>
                                <TableCell>{property.real_state_type.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}</TableCell>
                                <TableCell>{property.city}</TableCell>
                                <TableCell>{property.country}</TableCell>
                                <TableCell>
                                    <Button
                                        variant="outlined"
                                        color="primary"
                                        onClick={() => handleEdit(property)}
                                        sx={{ mr: 1 }}
                                    >
                                        Edit
                                    </Button>
                                    <Button
                                        variant="outlined"
                                        color="error"
                                        onClick={() => handleDelete(property.id)}
                                    >
                                        Delete
                                    </Button>
                                </TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </TableContainer>

            <Dialog open={open} onClose={() => setOpen(false)} maxWidth="md" fullWidth>
                <DialogTitle>
                    {selectedProperty ? 'Edit Property' : 'Add New Property'}
                </DialogTitle>
                <DialogContent>
                    <PropertyForm
                        property={selectedProperty}
                        onSubmit={handleFormSubmit}
                    />
                </DialogContent>
            </Dialog>
        </Box>
    );
}
